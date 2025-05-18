import os
import time
import re
import tkinter as tk
from tkinter import filedialog, messagebox, scrolledtext
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException, WebDriverException
import pandas as pd
from threading import Thread

class NFEApp:
    def __init__(self, master):
        self.master = master
        self.master.title("AutoNFe Downloader")
        self.master.geometry("800x500")
        self.master.configure(bg='#f0f0f0')

        self.planilha_arquivo = tk.StringVar()
        self.destino_path = tk.StringVar()
        self.is_paused = False
        self.is_stopped = False
        self.failed_chaves = []

        self.build_widgets()

    def build_widgets(self):
        tk.Label(self.master, text="Selecionar planilha (.xls, .xlsx, .csv):", bg='#f0f0f0', font=('Segoe UI', 12)).pack(pady=5)
        tk.Entry(self.master, textvariable=self.planilha_arquivo, width=80, font=('Segoe UI', 10)).pack(pady=5)
        tk.Button(self.master, text="Selecionar Arquivo de Planilha", command=self.select_planilha_file, bg='#4CAF50', fg='white', font=('Segoe UI', 10)).pack(pady=5)

        tk.Label(self.master, text="Pasta destino dos XMLs:", bg='#f0f0f0', font=('Segoe UI', 12)).pack(pady=5)
        tk.Entry(self.master, textvariable=self.destino_path, width=80, font=('Segoe UI', 10)).pack(pady=5)
        tk.Button(self.master, text="Selecionar Pasta de Destino", command=self.select_destino_folder, bg='#9C27B0', fg='white', font=('Segoe UI', 10)).pack(pady=5)

        tk.Button(self.master, text="Iniciar Download", command=self.iniciar_processo, bg='#2196F3', fg='white', font=('Segoe UI', 12)).pack(pady=10)
        tk.Button(self.master, text="Pausar", command=self.toggle_pause, bg='#FF9800', fg='white', font=('Segoe UI', 10)).pack(pady=3)
        tk.Button(self.master, text="Parar", command=self.stop_process, bg='#F44336', fg='white', font=('Segoe UI', 10)).pack(pady=3)
        tk.Button(self.master, text="Reprocessar Falhas", command=self.reprocess_failed, bg='#9C27B0', fg='white', font=('Segoe UI', 10)).pack(pady=3)
        tk.Button(self.master, text="Relatório de Erros", command=self.mostrar_erros, bg='#607D8B', fg='white', font=('Segoe UI', 10)).pack(pady=10)

    def select_planilha_file(self):
        file = filedialog.askopenfilename(filetypes=[("Planilhas", "*.xls *.xlsx *.csv")])
        if file:
            self.planilha_arquivo.set(file)

    def select_destino_folder(self):
        folder = filedialog.askdirectory()
        if folder:
            self.destino_path.set(folder)

    def toggle_pause(self):
        self.is_paused = not self.is_paused
        if self.is_paused:
            messagebox.showinfo("Pausado", "O processo foi pausado.")
        else:
            messagebox.showinfo("Retomando", "O processo foi retomado.")

    def stop_process(self):
        self.is_stopped = True
        messagebox.showinfo("Parado", "O processo foi interrompido.")

    def iniciar_processo(self):
        arquivo = self.planilha_arquivo.get()
        destino = self.destino_path.get()

        if not os.path.isfile(arquivo):
            messagebox.showerror("Erro", "Arquivo de planilha inválido.")
            return
        if not os.path.isdir(destino):
            os.makedirs(destino, exist_ok=True)

        options = Options()
        options.add_argument("--user-data-dir=C:\\Users\\Breno.Santos\\AppData\\Local\\Google\\Chrome\\User Data")
        options.add_argument("--profile-directory=Profile 1")
        options.add_argument("--start-maximized")
        options.add_experimental_option("prefs", {
            "download.default_directory": destino,
            "download.prompt_for_download": False,
            "download.directory_upgrade": True,
            "safebrowsing.enabled": True
        })

        print("Iniciando navegador...")
        try:
            driver = webdriver.Chrome(options=options)
        except WebDriverException as e:
            messagebox.showerror("Erro", f"Erro ao iniciar o navegador: {e}")
            return

        wait = WebDriverWait(driver, 20)
        url = "https://www.danfemagico.com.br/"

        def limpar_chave(chave):
            chave = str(chave).strip().replace("'", "")
            return chave if re.fullmatch(r"\d{44}", chave) else None

        def aguardar_download(timeout=60):
            arquivos_iniciais = set(os.listdir(destino))
            for _ in range(timeout * 4):  # 0.25s * 4 * timeout
                if self.is_stopped:
                    return None
                if self.is_paused:
                    time.sleep(0.25)
                    continue
                time.sleep(0.25)
                novos = set(os.listdir(destino)) - arquivos_iniciais
                for arquivo in novos:
                    if arquivo.lower().endswith(".xml"):
                        return arquivo
                if any(arquivo.endswith(".crdownload") for arquivo in novos):
                    continue
            return None

        try:
            if arquivo.endswith('.csv'):
                df = pd.read_csv(arquivo, dtype=str, sep=None, engine='python', on_bad_lines='skip')
            else:
                df = pd.read_excel(arquivo, engine='openpyxl' if arquivo.endswith('.xlsx') else 'xlrd')

            chaves = df['F'].dropna().apply(limpar_chave).dropna().tolist() if 'F' in df.columns else re.findall(r'\d{44}', df.to_string())

            print(f"\n📄 Lendo {len(chaves)} chaves do arquivo: {os.path.basename(arquivo)}")

            baixadas = 0

            for chave in chaves:
                if self.is_stopped:
                    break

                if self.is_paused:
                    time.sleep(1)
                    continue

                if not chave or len(chave) != 44:
                    print(f"🚫 Chave inválida: {chave}")
                    self.failed_chaves.append((chave, "Formato inválido"))
                    continue

                inicio = time.time()
                print(f"\n🔍 Processando chave: {chave}")
                driver.get(url)

                try:
                    campo_chave = wait.until(EC.presence_of_element_located((By.ID, "nfeKey")))
                    campo_chave.clear()
                    campo_chave.send_keys(chave)

                    botao_consultar = wait.until(EC.element_to_be_clickable((By.ID, "buscarBtn")))
                    driver.execute_script("arguments[0].scrollIntoView(true);", botao_consultar)
                    time.sleep(1)
                    botao_consultar.click()

                    botao_baixar = wait.until(EC.element_to_be_clickable((By.ID, "baixarXmlBtn")))
                    driver.execute_script("arguments[0].scrollIntoView(true);", botao_baixar)
                    time.sleep(1)
                    botao_baixar.click()

                    nome_arquivo = aguardar_download(timeout=60)
                    if nome_arquivo:
                        print(f"✅ Chave {chave} baixada: {nome_arquivo}")
                        baixadas += 1
                    else:
                        print(f"⚠️ Falha no download da chave {chave}.")
                        self.failed_chaves.append((chave, "Timeout no download"))

                except Exception as e:
                    print(f"❌ Erro ao processar chave {chave}: {e}")
                    self.failed_chaves.append((chave, str(e)))

                duracao = time.time() - inicio
                if duracao < 6:
                    time.sleep(6 - duracao)

            if self.failed_chaves:
                with open("erros_notas.txt", "w", encoding="utf-8") as f:
                    for chave, erro in self.failed_chaves:
                        f.write(f"{chave} - Erro: {erro}\n")
                print("📁 Erros salvos em erros_notas.txt")

            print("\n✔️ Processo finalizado.")
            messagebox.showinfo("Concluído", f"Processamento finalizado! \nNotas baixadas: {baixadas} \nNotas com erro: {len(self.failed_chaves)}")
        except Exception as e:
            print(f"❌ Erro ao ler a planilha ou processar dados: {e}")
        finally:
            driver.quit()

    def mostrar_erros(self):
        if not self.failed_chaves:
            messagebox.showinfo("Sem Erros", "Nenhuma chave com erro até o momento.")
            return

        relatorio = tk.Toplevel(self.master)
        relatorio.title("Relatório de Erros")
        relatorio.geometry("700x400")

        texto = scrolledtext.ScrolledText(relatorio, wrap=tk.WORD, font=("Segoe UI", 10))
        texto.pack(expand=True, fill='both', padx=10, pady=10)

        for chave, erro in self.failed_chaves:
            texto.insert(tk.END, f"{chave} - Erro: {erro}\n")
        texto.config(state='normal')

    def reprocess_failed(self):
        if not self.failed_chaves:
            messagebox.showinfo("Sem Falhas", "Não há chaves para reprocessar.")
            return

        messagebox.showinfo("Reprocessando", "Iniciando reprocessamento das chaves não baixadas.")
        chaves_para_reprocessar = self.failed_chaves.copy()
        self.failed_chaves.clear()

        for chave, _ in chaves_para_reprocessar:
            self.iniciar_processo()

if __name__ == "__main__":
    root = tk.Tk()
    app = NFEApp(root)
    root.mainloop()
