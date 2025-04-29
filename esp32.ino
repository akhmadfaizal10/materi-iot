#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "UDINUS I.4";
const char* password = "";
const int ledPin = 2;
String serverName = "http://192.168.6.134/materi-iot/api.php"; // ganti sesuai IP/server kamu

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  pinMode(ledPin,OUTPUT);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Menghubungkan ke WiFi...");
  }
  Serial.println("Terhubung ke WiFi");
}


void loop() {
  float suhu = random(200, 350) ;        
  float kelembaban = random(300, 800) ;  

  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String data = "suhu=" + String(suhu) + "&kelembaban=" + String(kelembaban);
    int httpResponseCode = http.POST(data);
    Serial.println("Kirim data: " + data);
    Serial.println("Response Code: " + String(httpResponseCode));
    http.end();

    // Cek status LED
    http.begin("http://192.168.6.134/materi-iot/led_status.php"); 
    int code = http.GET();
    if (code == 200) {
      String response = http.getString();
      Serial.println("Status LED: " + response);
      if (response == "ON") {
        digitalWrite(ledPin, HIGH);
      } else if (response == "OFF") {
        digitalWrite(ledPin, LOW);
      }
    } else {
      Serial.println("Gagal ambil status LED");
    }
    http.end();
  
  }

  delay(10000); // kirim setiap 10 detik
}
