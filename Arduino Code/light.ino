#include <DHT.h>
#include <math.h>
DHT dht(2, DHT11);

int aPin=3;
int bPin=5;
int cPin=6;
int analogtemp;
int analogtrack;
int astatus=0;

int aVal=0;
int bVal=0;
int cVal=0;
int track;
int trackpower=9;

String input="";

int change=1;

double Thermistor(int RawADC) {
  double Temp;
  Temp = log(10000.0*((1024.0/RawADC-1))); 
  Temp = 1 / (0.001129148 + (0.000234125 + (0.0000000876741 * Temp * Temp ))* Temp );
  Temp = 273.15-Temp ;            // Convert Kelvin to Celcius
   //Temp = (Temp * 9.0)/ 5.0 + 32.0; // Convert Celcius to Fahrenheit
   return Temp;
}

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  Serial.print("Hello world");
  dht.begin();
  pinMode(aPin,OUTPUT);
  pinMode(bPin,OUTPUT);
  pinMode(cPin,OUTPUT);
  pinMode(analogtrack,OUTPUT);
  pinMode(trackpower,OUTPUT);
}

void loop() {
   track = digitalRead(A1);
  if(track==HIGH && astatus==0){
     aVal=0;
    analogWrite(aPin, aVal);
    Serial.write("of");
  }
  else if(track==LOW && astatus==0){
     aVal=255;
    analogWrite(aPin, aVal);
    Serial.write("on");
    delay(10000);
   
   
  }
  // put your main code here, to run repeatedly:
  if(Serial.available()){
    input=Serial.readString();
    if(input=="a"){
      aVal=255; 
      astatus=1;
    }else if(input=="aa"){
      aVal=0;
      astatus=0;
    }
     
    if(input=="b"){
      bVal=255;
    } else if(input=="bb"){
      bVal=0;
    }

    if(input=="c"){
      cVal=255;
    }else if(input=="cc"){
      cVal=0; 
    }
    
    input="";
    change=1;
  }
  if (change) {
    change=0;
    analogWrite(aPin, aVal);
    analogWrite(bPin, bVal);
    analogWrite(cPin, cVal);
  }
  
  analogtemp = analogRead(A0);
  double temp = Thermistor(analogtemp);
  Serial.print(temp);
  delay(1000);

//  analogWrite(trackpower,255);
  
 
}
