#include <hidboot.h>
#include <hiduniversal.h>
//#include <SoftwareSerial.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27,16,2);

//SoftwareSerial esp(2,3);

long waktu=0;

bool state=false;
String DataBarcode;
String baris1="";
String baris2="";
int total=0;
int harga;
bool x = false, y=false;
String keranjang="Keranjang 1";
int button=4;

class KbdRptParser : public KeyboardReportParser
{
    void PrintKey(uint8_t mod, uint8_t key);

  protected:
    void OnControlKeysChanged(uint8_t before, uint8_t after);

    void OnKeyDown  (uint8_t mod, uint8_t key);
    void OnKeyUp  (uint8_t mod, uint8_t key);
    void OnKeyPressed(uint8_t key);
};

void KbdRptParser::PrintKey(uint8_t m, uint8_t key)
{
  MODIFIERKEYS mod;
  *((uint8_t*)&mod) = m;
}

void KbdRptParser::OnKeyDown(uint8_t mod, uint8_t key)
{
  PrintKey(mod, key);
  uint8_t c = OemToAscii(mod, key);

  if (c)
    OnKeyPressed(c);
}

void KbdRptParser::OnControlKeysChanged(uint8_t before, uint8_t after) {

  MODIFIERKEYS beforeMod;
  *((uint8_t*)&beforeMod) = before;

  MODIFIERKEYS afterMod;
  *((uint8_t*)&afterMod) = after;
}

void KbdRptParser::OnKeyUp(uint8_t mod, uint8_t key)
{
  //Serial.print("UP ");
  //PrintKey(mod, key);
}

void KbdRptParser::OnKeyPressed(uint8_t key)
{
  //Serial.print((char)key);
  if (key == 0x0D){
    x = true;
  }else{
    DataBarcode += (char)key;
  }
}


USB Usb;
HIDUniversal Hid(&Usb);

KbdRptParser Prs;

void setup()
{
  Serial.begin( 115200 );

  Serial.println("Start");

  lcd.init();
  lcd.backlight();
  if (Usb.Init() == -1){
    lcd.setCursor(0,0);
    lcd.print("OSC did not start.");
  }
  delay( 200 );

  Hid.SetReportParser(0, &Prs);
  lcd.setCursor(0,0);
  lcd.print(keranjang);
  lcd.setCursor(0,1);
  lcd.print(total);
}

void loop()
{
  Usb.Task();

  while(Serial.available()>0){
    String a=Serial.readStringUntil(',');
    String b=Serial.readStringUntil(',');
    String c=Serial.readStringUntil(0x0D);
    harga=a.toInt();
    baris1=b;
    baris2=c;
//    Serial.print(baris1);
//    Serial.print(baris2);
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print(baris1);
    lcd.setCursor(0,1);
    lcd.print(baris2);
    a="";
    b="";
    c="";
    if(harga<0){
      total=0;
    }else{
      total=total+harga;
    }
   y=true;
   waktu=millis(); 
  }
  
  if (x){
    lcd.clear();
    Serial.print(DataBarcode);
    //esp.print(DataBarcode);
    x = false;
    lcd.setCursor(0,0);
    lcd.print("Kode");
    lcd.setCursor(0,1);
    lcd.print(DataBarcode);
    DataBarcode = "";
    //waktu=millis();
    //y=true; 
  }

  if (digitalRead(button) == HIGH){
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Lepaskan");
    lcd.setCursor(0,1);
    lcd.print("Tombol");
    state=true;
  }
  
  if (state){
    if(digitalRead(button) == LOW){
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print(keranjang);
      lcd.setCursor(0,1);
      lcd.print(total);
      //esp.print("CEK");
      Serial.print("CEK");
      state=false;
    }
  }

  
  while(y){
    if(millis()-waktu>=1000){
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print(keranjang);
      lcd.setCursor(0,1);
      lcd.print(total);
      y=false;
    }
  }
}
