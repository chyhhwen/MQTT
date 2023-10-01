#include<WiFi.h>
#include <HTTPClient.h>
#include <SimpleDHT.h>
int pinDHT11 = 13;
int pinflame = 12;
SimpleDHT11 dht11(pinDHT11);

const char ssid[]="122-wifi"; 
const char pwd[]="123456789"; 

void setup() 
{
  pinMode(pinflame, INPUT);

  Serial.begin(9600);

  WiFi.mode(WIFI_STA); 
  WiFi.begin(ssid,pwd); 

  Serial.print("WiFi connecting");

  while(WiFi.status()!=WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);   
  }

  Serial.println("");
  Serial.print("IP位址:");
  Serial.println(WiFi.localIP()); 
  Serial.print("WiFi RSSI:");
  Serial.println(WiFi.RSSI()); 

}

void loop() 
{

  byte temperature = 0;
  byte humidity = 0;
  int err = SimpleDHTErrSuccess;
  if ((err = dht11.read(&temperature, &humidity, NULL)) != SimpleDHTErrSuccess) 
  {
    Serial.print("Read DHT11 failed, err="); Serial.println(err);delay(1000);
    return;
  }

 if (WiFi.status() == WL_CONNECTED) 
 {
        HTTPClient http;
        /*DHT11*/
        http.begin("https://192.168.1.125/api/dht_add.php");

        String postData = "temp="; 
        postData = postData + (int)temperature; 
        postData = postData + "&humi="; 
        postData = postData + (int)humidity ; 

        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        int httpCode = http.POST(postData);

        if (httpCode > 0) 
        {
            String payload = http.getString();
            Serial.println(payload);
        } 
        else 
        {
            Serial.println("Error on HTTP request");
        }

        http.end();
        /*flame*/
        int flameValue = digitalRead(flamePin);

        http.begin("https://192.168.1.125/api/flame_add.php");

        String postData = "heat="; 
        postData = postData + flameValue; 

        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        int httpCode = http.POST(postData);

        if (httpCode > 0) 
        {
            String payload = http.getString();
            Serial.println(payload);
        } 
        else 
        {
            Serial.println("Error on HTTP request");
        }

        http.end();

  }
    delay(60000); 

}