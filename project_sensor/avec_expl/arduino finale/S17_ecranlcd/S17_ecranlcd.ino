
#include "DHT.h"  //declaration library humidity/temperature sensor
#include <MQ135.h> //declaration library gas sensor
#include <LiquidCrystal.h> ////declaration library lcd

//humidity and temperature sensor parameters
#define DHTPIN 2  
#define DHTTYPE DHT11

//pin initialization
const int luminositePin = A0;
const int airQualityPin = A1; 
const int uvSensorPin = A2; 

//initialization of library parameters
MQ135 gasSensor = MQ135(airQualityPin);
DHT dht(DHTPIN, DHTTYPE);
LiquidCrystal lcd(13,12,11,10,9,8);
void setup() {
//I/O parameter initialization
  pinMode(uvSensorPin, INPUT);
  pinMode(luminositePin, INPUT);
  pinMode(airQualityPin, INPUT);
  dht.begin();
  lcd.begin(16,2);
  Serial.begin(9600);
}

void loop() {
  //***** for temperature and humidity
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();
  
  //******for gas
 
  float airQualityValue = gasSensor.getPPM();
  //***pour la luminosité
  float luminosite = analogRead(luminositePin);
  
  //*** For UV sensor 
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


//displaying variables in the series monitor
Serial.print(luminosite);
Serial.print(",");
Serial.print(temperature);
Serial.print(",");
Serial.print(humidity);
Serial.print(",");
Serial.print(airQualityValue);
Serial.print(",");
Serial.println(uvIntensity);

//converting int variables to float
int luminositeInt = int(luminosite);
int temperatureInt = int(temperature);
int humidityInt = int(humidity);
int airQualityValueInt = int(airQualityValue);
int uvIntensityInt = int(uvIntensity);

//data display on lcd screen
lcd.setCursor(0, 0);
lcd.print("L:");
lcd.print(luminositeInt);
lcd.print(" T:");
lcd.print(temperatureInt);
lcd.print(" H:");
lcd.print(humidityInt);

lcd.setCursor(0, 1);
lcd.print(" AQ:");
lcd.print(airQualityValueInt);
lcd.print(" UV:");
lcd.print(uvIntensityInt);
delay(1000);
}
