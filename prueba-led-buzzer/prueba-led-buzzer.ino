#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

// Definición de pines
const int buttonPin = 5;    // Pin del botón (GPIO 5 corresponde a D1)
const int buzzerPin = 12;   // Pin del zumbador (GPIO 12 corresponde a D6)
const int ledPin = 14;      // Pin del LED (GPIO 14 corresponde a D5)

const char* ssid = "Estudiantes";
const char* password = "Educar_2018";
const char* server = "http://alertaazult2.000webhostapp.com/alarma.php";

void setup() {
  Serial.begin(115200);

  // Configuración de pines
  pinMode(buttonPin, INPUT_PULLUP);
  pinMode(buzzerPin, OUTPUT);
  pinMode(ledPin, OUTPUT);

  // Conectar a WiFi
  conectarWiFi();

  // Añadir un retardo adicional
  delay(2000); // Espera para estabilizar
}

void loop() {
  int buttonState = digitalRead(buttonPin);

  if (buttonState == HIGH) {
    digitalWrite(ledPin, HIGH);  // Enciende el LED
    
    for (int i = 0; i < 3; i++) {
      tone(buzzerPin, 1000);       // Activa el zumbador
      delay(3000);                 // Espera 3 segundos
      noTone(buzzerPin);         // Apaga el zumbador
      delay(2000);               // Espera 2 segundos
    }
    sendAlarmToServer();         // Enviar señal de alarma al servidor
    digitalWrite(ledPin, LOW);   // Apaga el LED
  } else {
    digitalWrite(ledPin, LOW);   // Apaga el LED
    noTone(buzzerPin);           // Apaga el zumbador
  }
}

void conectarWiFi() {
  // WiFi.persistent(false);    // No guardar configuración en la memoria flash
  // WiFi.mode(WIFI_STA);       // Configura el ESP8266 en modo estación
  //  WiFi.setOutputPower(10);   // Configura la potencia de transmisión a 10 dBm
  WiFi.begin(ssid, password);
  yield();
  Serial.print("Conectando a WiFi");
  unsigned long startTime = millis();

  while (WiFi.status() != WL_CONNECTED && millis() - startTime < 10000) { // Intentar conectar por 10 segundos
    delay(500);
    Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\nConectado a WiFi");
  } else {
    Serial.println("\nError al conectar a WiFi");
  }

  delay(2000); // Retardo para estabilizar
}

void sendAlarmToServer() {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    http.begin(client, server);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String payload = "status=ALARM";
    int httpResponseCode = http.POST(payload);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.println("Error en la solicitud POST");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("Error de conexión WiFi");
  }
}
