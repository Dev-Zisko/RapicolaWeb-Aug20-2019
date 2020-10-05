import os, time

def command(hour):
  if hour == "00":
    print("Son las 12am, se reiniciara el estado de las colas.")
    os.system("php artisan status:queues")
  else:
    print("El estado de las colas no puede reiniciarse, no son las 12am.")

while(True):
  hour = time.strftime("%H")
  print("La hora del servidor es: ", hour, ".")
  command(hour)
  time.sleep(1800)