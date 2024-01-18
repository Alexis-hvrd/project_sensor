import mysql.connector as msqlc
from datetime import date, datetime
import serial
import time

#connexion à la base de données
try:
    bd = msqlc.connect(
        host = "localhost",
        port = 3306 , 
        user = "root",
        passwd = "",
        database = "mydatabase"
    )
except Exception:
    print("connexion impossible à la base de données")

#mise en place de la fonction
cursor = bd.cursor()
query = "INSERT INTO mydata (dateA, hoursA, Temperature,Luminosity,Humidity,AirQuality,UVvalue) VALUES (%s, %s, %s, %s, %s,%s,%s)"
#boucle qui enregistre les données


with serial.Serial(('COM5'), 9600, timeout=0.05) as comarduino:
    while True:
        data = comarduino.readline()
        print(data.decode('utf-8'))

        values = data.decode('utf-8').strip().split(',')
        if len(values) == 5:
            luminosity = values[0]
            temperature = values[1]
            humidity = values[2]
            airQuality = values[3]
            uvValue = values[4]

            now = datetime.now()
            date_acquisition = now.strftime("%Y-%m-%d")
            heure_acquisition = now.strftime("%H:%M:%S")

            # Enregistrement des valeurs dans la base de données
            cursor.execute(query, (date_acquisition, heure_acquisition, temperature,luminosity, humidity,airQuality,uvValue))
       
            bd.commit()

        

        time.sleep(2) 
