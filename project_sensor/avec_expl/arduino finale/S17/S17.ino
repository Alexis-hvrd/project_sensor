
#include "DHT.h"
#include <MQ135.h>

#define DHTPIN 2
#define DHTTYPE DHT11

const int luminositePin = A0;
const int airQualityPin = A1; 
const int uvSensorPin = A2; 

MQ135 gasSensor = MQ135(airQualityPin);
DHT dht(DHTPIN, DHTTYPE);

float voltage;
float degreesC;
float lux;

void setup() {

  pinMode(uvSensorPin, INPUT);
  pinMode(luminositePin, INPUT);
  pinMode(airQualityPin, INPUT);
  dht.begin();
  Serial.begin(9600);
}

void loop() {
  //***** pour la temperature et humidité
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();
  
  //******pour le gas
 
  float airQualityValue = gasSensor.getPPM();
  //***pour la luminosité
  float luminosite = analogRead(luminositePin);
  
  //*** Pour les UV 
int lecture = analogRead(uvSensorPin);
int taux = map(lecture,0,669,0,1023);
int uvIntensity;
if (taux<50){
  uvIntensity =0;
}
else if (taux<227){
  uvIntensity =1;
}
else if (taux<318){
  uvIntensity =2;
}
else if (taux<408){
  uvIntensity =3;
}
else if (taux<503){
  uvIntensity =4;
}
else if (taux<606){
  uvIntensity =5;
}
else if (taux<795){
  uvIntensity =7;
}
else if (taux<881){
  uvIntensity =8;
}
else if (taux<976){
  uvIntensity =9;
}
else if (taux<1074){
  uvIntensity =10;
}


 
Serial.print(luminosite);
Serial.print(",");
Serial.print(temperature);
Serial.print(",");
Serial.print(humidity);
Serial.print(",");
Serial.print(airQualityValue);
Serial.print(",");
Serial.println(uvIntensity);

delay(1000);
}
