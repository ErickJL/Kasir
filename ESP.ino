#include <ESP8266WiFi.h>

const char* ssid = "Simprug";
const char* password = "simprug123";
//const char* ssid = "Command Center";
//const char* password = "Buruanbangun";
const char* host = "192.168.1.12";
const int port = 80;

String keranjang="1";
bool cek=false;
bool web=false;
String line;

String id="";//THE id WHOSE DATA YOU WANT TO FETCH


void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.print("0,MOHON,TUNGGU");
  while (WiFi.status() != WL_CONNECTED){
    delay(1000);
  }
  Serial.print("0,WIFI,TERHUBUNG");
}

void loop(){
  //Baca Serial
  while (Serial.available()>0){
    id = Serial.readString();
    Serial.print("0,Tunggu,Sebentar");
    if(id=="CEK"){
      cek=true;
    }else{
      web=true;
    }
  }

  //Data
  if(web){
    WiFiClient client;
  delay(100);
    if(!client.connect(host, port)){
      Serial.print("0,GAGAL,HOST-PORT");
      delay(5000);
      return;
    }
    
    client.print(String("GET ")+"/Kasir/simpan.php?keranjang="+keranjang+"&id="+id+
                " HTTP/1.1\r\n"+"Host: "+host+"\r\n"+"Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        client.stop();
        Serial.print("0,GAGAL,CLIENT");
        delay(60000);
        return;
      }
    }
    
    while(client.available()){
      line = client.readStringUntil('\n');
    }
    
    Serial.print(line);
    web=false;
  }

  //CEK DATA
  if(cek){
    
    WiFiClient client;
    delay(100);
      if(!client.connect(host, port)){
        Serial.print("0,GAGAL,HOST-PORT");
        delay(5000);
        return;
      }
      
      client.print(String("GET ")+"/Kasir/cekstatus.php?keranjang="+keranjang+
                  " HTTP/1.1\r\n"+"Host: "+host+"\r\n"+"Connection: close\r\n\r\n");
      unsigned long timeout = millis();
      while (client.available() == 0) {
        if (millis() - timeout > 5000) {
          Serial.print("0,GAGAL,CLIENT");
          client.stop();
          delay(60000);
          return;
        }
      }
      
      while(client.available()){
        line = client.readStringUntil('\n');
      }
      
      Serial.print(line);
      cek=false;
  }
}
