import random

from .extragere_wikipedia import genereaza_lista_nume, genereaza_lista_prenume


class Generator:
    _lista_nume = []
    _lista_prenume = []

    def __init__(self):
        self._lista_nume = genereaza_lista_nume()
        self._lista_prenume = genereaza_lista_prenume()

    def genereaza(self):
        prenume = random.choice(self._lista_prenume)
        nume = random.choice(self._lista_nume)
        self._lista_nume.remove(nume)  # sterge numele generat pentru a evita o potentiala dublare in baza de date
        return prenume + ' ' + nume


class GeneratorNume():
    def __init__(self):
        self.lista = genereaza_lista_nume()

    def genereaza(self):
        nume = random.choice(self.lista)
        self.lista.remove(nume)
        return nume


class GeneratorPrenume():
    def __init__(self):
        self.lista = genereaza_lista_prenume()

    def genereaza(self):
        prenume = random.choice(self.lista)
        self.lista.remove(prenume)
        return prenume
