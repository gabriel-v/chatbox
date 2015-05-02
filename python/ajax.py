from nume import GeneratorNume, GeneratorPrenume
from propozitii import GeneratorHaiku, GeneratorWired, GeneratorTabloid, GeneratorKant
from json import JSONEncoder
import sys

json = JSONEncoder()

n = int(sys.argv[1])
tip = sys.argv[2]
raspuns = []
if tip == "haiku":
    gen = GeneratorHaiku()
elif tip == "tabloid":
    gen = GeneratorTabloid()
elif tip == "wired":
    gen = GeneratorWired()
elif tip == "nume":
    gen = GeneratorNume()
elif tip == "prenume":
    gen = GeneratorPrenume()
elif tip == "kant":
    gen = GeneratorKant()
else:
    raspuns = ["eroare!!!"]
    print(json.encode(raspuns))
    exit()

for i in range(n):
    raspuns.append(gen.genereaza())
print(json.encode(raspuns))

# def application(env, start_response):
#     status = '200 OK'
#     output = json.encode(raspuns)
#
#     response_headers = [('Content-type', 'text/plain'),
#                         ('Content-Length', str(len(output)))]
#     start_response(status, response_headers)
#
#     return [output]
# print(json.encode(raspuns))


