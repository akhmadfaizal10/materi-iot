#include <ESP32Servo.h>

Servo myServo;

int servoPin = 13;  // Pilih pin PWM-capable (misalnya 18, 19, 21, dst)

void setup() {
  Serial.begin(115200);
  myServo.attach(servoPin);  // Attach servo ke pin
  Serial.println("Servo ");
}

void loop() {
  // Gerak dari 0 ke 180 derajat
  for (int pos = 0; pos <= 180; pos++) {
    myServo.write(pos);
    delay(15);  // delay buat gerakan halus
  }

  delay(1000); 

  // Balik dari 180 ke 0 derajat
  for (int pos = 180; pos >= 0; pos--) {
    myServo.write(pos);
    delay(15);
  }

  delay(1000);
}
