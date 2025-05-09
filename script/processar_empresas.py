import os
import time
import pyperclip
import pytesseract
import mysql.connector
import tkinter as tk
from tkinter import messagebox
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from dotenv import load_dotenv
import datetime

# Carrega variáveis do .env
load_dotenv()

# Caminho para Tesseract
pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

# Diretório base
PASTA_RAIZ = r"Z:\\Breno\\empresas"

# Conectar ao banco de dados
def conectar_banco():
    return mysql.connector.connect(
        host=os.getenv("DB_HOST", "localhost"),
        user=os.getenv("DB_USER", "root"),
        password=os.getenv("DB_PASSWORD", "Bomfim1212$"),
        database=os.getenv("DB_NAME", "SistemaNotas")
    )

def criar_tabela_empresas():
    conn = conectar_banco()
    cursor = conn.cursor()
    cursor.execute("""
        CREATE TABLE IF NOT EXISTS empresas (
            codigo_empresa VARCHAR(255) PRIMARY KEY,
            cnpj VARCHAR(20) NOT NULL
        )
    """)
    conn.commit()
    conn.close()

def cadastrar_empresa(codigo, cnpj):
    conn = conectar_banco()
    cursor = conn.cursor()
    cursor.execute("REPLACE INTO empresas (codigo_empresa, cnpj) VALUES (%s, %s)", (codigo, cnpj))
    conn.commit()
    conn.close()

def obter_cnpj_por_codigo(codigo_empresa):
    conn = conectar_banco()
    cursor = conn.cursor()
    cursor.execute("SELECT cnpj FROM empresas WHERE codigo_empresa = %s", (codigo_empresa,))
    resultado = cursor.fetchone()
    conn.close()
    return resultado[0] if resultado else None

def verificar_sped_em_pasta(caminho_empresa):
    arquivos_txt = [f for f in os.listdir(caminho_empresa) if f.lower().endswith(".txt")]
    return os.path.join(caminho_empresa, arquivos_txt[0]) if arquivos_txt else None

def esconder_popups(driver):
    for popup_id in ["img-popup", "popUpContent", "modalYouTube"]:
        try:
            popup = driver.find_element(By.ID, popup_id)
            driver.execute_script("arguments[0].style.display = 'none';", popup)
        except Exception:
            pass

def clicar_lento(driver, elemento, delay=1.5):
    driver.execute_script("arguments[0].scrollIntoView(true);", elemento)
    time.sleep(delay)
    elemento.click()
    time.sleep(delay)

def tentar_colar_cnpj(driver, cnpj):
    for _ in range(3):
        try:
            btn_certificados = WebDriverWait(driver, 15).until(
                EC.element_to_be_clickable((By.CSS_SELECTOR, "button[data-id='ddlDownloadByCertificate']"))
            )
            clicar_lento(driver, btn_certificados)
            input_busca = WebDriverWait(driver, 15).until(
                EC.element_to_be_clickable((By.CSS_SELECTOR, "input[aria-label='Search']"))
            )
            driver.execute_script("arguments[0].focus();", input_busca)
            input_busca.clear()
            pyperclip.copy(cnpj)
            input_busca.send_keys(Keys.CONTROL, 'v')
            input_busca.send_keys(Keys.ENTER)
            return True
        except Exception:
            time.sleep(2)
    return False

def salvar_log_execucao(codigo_empresa, cnpj, status, mensagem, duracao):
    try:
        conn = conectar_banco()
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO logs_execucao (codigo_empresa, cnpj, status, mensagem, duracao_segundos)
            VALUES (%s, %s, %s, %s, %s)
        """, (codigo_empresa, cnpj, status, mensagem, duracao))
        conn.commit()
        conn.close()
    except Exception as e:
        print(f"[ERRO] Falha ao salvar log de execução: {e}")

def processar_empresa(driver, nome_pasta, caminho_sped, cnpj):
    inicio = time.time()
    try:
        caminho_empresa = os.path.dirname(caminho_sped)

        # Etapa 1: Envio ao FSist
        driver.get("https://www.fsist.com.br/chaves-nfe-sped")
        clicar_lento(driver, WebDriverWait(driver, 60).until(EC.element_to_be_clickable((By.ID, "arquivolab"))))
        driver.find_element(By.ID, "arquivo").send_keys(caminho_sped)
        clicar_lento(driver, driver.find_element(By.CLASS_NAME, "butenviar"))
        clicar_lento(driver, WebDriverWait(driver, 60).until(EC.element_to_be_clickable((By.ID, "msgsim"))))
        try:
            clicar_lento(driver, WebDriverWait(driver, 30).until(EC.element_to_be_clickable((By.ID, "msgok"))))
        except:
            pass

        # Aguarda a geração do arquivo de resposta
        time.sleep(5)

        # Etapa 2: Pega o arquivo .txt mais recente (resposta FSist)
        def encontrar_arquivo_mais_recente(pasta):
            arquivos_txt = [
                os.path.join(pasta, f)
                for f in os.listdir(pasta)
                if f.lower().endswith(".txt")
            ]
            if not arquivos_txt:
                return None
            arquivos_txt.sort(key=os.path.getmtime, reverse=True)
            return arquivos_txt[0]

        arquivo_mais_recente = encontrar_arquivo_mais_recente(caminho_empresa)
        if not arquivo_mais_recente:
            salvar_log_execucao(nome_pasta, cnpj, "erro", "Nenhum arquivo .txt encontrado para subir no Sieg", time.time() - inicio)
            return False

        # Etapa 3: Envio ao Sieg
        driver.get("https://hub.sieg.com/#")
        time.sleep(5)
        try:
            btn_add = WebDriverWait(driver, 60).until(
                EC.presence_of_element_located((By.CSS_SELECTOR, "a[data-target='#modalAddKey']"))
            )
            clicar_lento(driver, btn_add)
            WebDriverWait(driver, 30).until(EC.visibility_of_element_located((By.ID, "modalAddKey")))
        except:
            driver.execute_script('document.querySelector("a[data-target=\'#modalAddKey\']").click()')
            WebDriverWait(driver, 30).until(EC.visibility_of_element_located((By.ID, "modalAddKey")))

        esconder_popups(driver)

        if not tentar_colar_cnpj(driver, cnpj):
            salvar_log_execucao(nome_pasta, cnpj, "erro", "Falha ao colar CNPJ", time.time() - inicio)
            return False

        input_arquivo = WebDriverWait(driver, 60).until(
            EC.presence_of_element_located((By.ID, "txtKeysByTxt"))
        )
        input_arquivo.send_keys(arquivo_mais_recente)

        clicar_lento(driver, WebDriverWait(driver, 20).until(EC.element_to_be_clickable((By.ID, "btnAddKeys"))))
        salvar_log_execucao(nome_pasta, cnpj, "sucesso", "Processado com sucesso", time.time() - inicio)
        return True

    except Exception as e:
        salvar_log_execucao(nome_pasta, cnpj, "erro", str(e), time.time() - inicio)
        print(f"[ERRO] Empresa {nome_pasta}: {str(e)}")
        return False

def iniciar_execucao():
    chrome_options = Options()
    chrome_options.add_argument("--user-data-dir=C:\\Users\\Breno.Santos\\AppData\\Local\\Google\\Chrome\\User Data")
    chrome_options.add_argument("--profile-directory=Profile 1")
    chrome_options.add_argument("--disable-blink-features=AutomationControlled")

    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=chrome_options)
    empresas_com_erro = []

    for nome_pasta in os.listdir(PASTA_RAIZ):
        caminho_empresa = os.path.join(PASTA_RAIZ, nome_pasta)
        if not os.path.isdir(caminho_empresa):
            continue
        cnpj = obter_cnpj_por_codigo(nome_pasta)
        if not cnpj:
            empresas_com_erro.append(nome_pasta)
            continue
        caminho_sped = verificar_sped_em_pasta(caminho_empresa)
        if not caminho_sped:
            empresas_com_erro.append(nome_pasta)
            continue
        if not processar_empresa(driver, nome_pasta, caminho_sped, cnpj):
            empresas_com_erro.append(nome_pasta)

    driver.quit()

    if empresas_com_erro:
        mostrar_resultados_erro(empresas_com_erro)
    else:
        messagebox.showinfo("Concluído", "Processo finalizado com sucesso!")

def mostrar_resultados_erro(lista_empresas):
    erro_janela = tk.Tk()
    erro_janela.title("Empresas com Erros")
    tk.Label(erro_janela, text="Empresas não processadas:", font=("Arial", 12)).pack(pady=10)
    for emp in lista_empresas:
        tk.Label(erro_janela, text=f"- {emp}").pack()
    tk.Button(erro_janela, text="Fechar", command=erro_janela.destroy).pack(pady=10)
    erro_janela.mainloop()

def abrir_janela_cadastro():
    cadastro = tk.Toplevel()
    cadastro.title("Cadastrar Empresa")
    tk.Label(cadastro, text="Código da Empresa:").grid(row=0, column=0, padx=5, pady=5)
    tk.Label(cadastro, text="CNPJ:").grid(row=1, column=0, padx=5, pady=5)

    entry_codigo = tk.Entry(cadastro)
    entry_cnpj = tk.Entry(cadastro)
    entry_codigo.grid(row=0, column=1, padx=5, pady=5)
    entry_cnpj.grid(row=1, column=1, padx=5, pady=5)

    def salvar():
        codigo = entry_codigo.get().strip()
        cnpj = entry_cnpj.get().strip()

        if not codigo or not cnpj:
            messagebox.showwarning("Atenção", "Preencha todos os campos.")
            return

        try:
            cadastrar_empresa(codigo, cnpj)
            print(f"[INFO] Empresa cadastrada: {codigo} - {cnpj}")
            messagebox.showinfo("Sucesso", "Empresa cadastrada com sucesso.")
            cadastro.destroy()
        except Exception as e:
            print(f"[ERRO] Falha ao cadastrar empresa: {e}")
            messagebox.showerror("Erro", f"Erro ao salvar no banco de dados:\n{str(e)}")

    tk.Button(cadastro, text="Salvar", command=salvar).grid(row=2, column=0, columnspan=2, pady=10)

def iniciar_interface():
    criar_tabela_empresas()
    root = tk.Tk()
    root.title("Automatização FSist")
    tk.Label(root, text="Sistema de Cadastro e Execução", font=("Arial", 14)).pack(pady=10)

    tk.Button(root, text="Cadastrar Empresa", command=abrir_janela_cadastro).pack(pady=10)

    # ✅ Agora mantém a interface aberta
    tk.Button(root, text="Iniciar Processo", command=iniciar_execucao).pack(pady=10)

    # ✅ Novo botão para abrir Chrome e encerrar
    tk.Button(root, text="Abrir Navegador (Finalizar)", bg="#28a745", fg="white", command=abrir_chrome_normal).pack(pady=20)

    root.mainloop()



def abrir_chrome_normal():
    try:
        chrome_path = r"C:\Program Files\Google\Chrome\Application\chrome.exe"
        os.startfile(chrome_path)  # Abre o Chrome como um programa normal
        print("[INFO] Chrome aberto normalmente.")
    except Exception as e:
        print(f"[ERRO] Falha ao abrir o Chrome: {e}")
        messagebox.showerror("Erro", "Não foi possível abrir o Google Chrome.")
    finally:
        exit()  # Encerra o script após abrir o navegador


if __name__ == "__main__":
    iniciar_interface()

def abrir_chrome_normal():
    try:
        chrome_path = r"C:\Program Files\Google\Chrome\Application\chrome.exe"
        os.startfile(chrome_path)
        print("[INFO] Chrome aberto normalmente.")
    except Exception as e:
        print(f"[ERRO] Falha ao abrir o Chrome: {e}")
        messagebox.showerror("Erro", "Não foi possível abrir o Google Chrome.")
    finally:
        exit()
