#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Definición de pines
const int buttonPin = 5;    // Pin del botón (GPIO 5 corresponde a D1)
const int buzzerPin = 12;   // Pin del zumbador (GPIO 12 corresponde a D6)
const int ledPin = 14;      // Pin del LED (GPIO 14 corresponde a D5)

const char* ssid = "Maestros";           // Nombre de la red WiFi
const char* password = "Maestros_2021";  // Contraseña del WiFi
const char* server = "10.0.20.45";       // Dirección IP del servidor
const int port = 80;                     // Puerto del servidor

int habitacion_id = 2;                   // Define el habitacion_id que quieras enviar

bool alreadySent = false;                // Bandera para saber si ya se envió la petición

void setup(void) {
  Serial.begin(115200);

  // Inicialización de pines
  pinMode(buttonPin, INPUT);
  pinMode(ledPin, OUTPUT);
  pinMode(buzzerPin, OUTPUT);

  // Conexión WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi conectado");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  int buttonState = digitalRead(buttonPin);

  if (buttonState == HIGH && !alreadySent) {
    digitalWrite(ledPin, HIGH);  // Enciende el LED
    
    // Activa el zumbador 3 veces
    for (int i = 0; i < 3; i++) {
      tone(buzzerPin, 1000);  // Activa el zumbador
      delay(3000);            // Espera 3 segundos
      noTone(buzzerPin);      // Apaga el zumbador
      delay(2000);            // Espera 2 segundos
    }

    // Enviar datos al servidor (una vez)
    if (WiFi.status() == WL_CONNECTED) {
      WiFiClient client;
      HTTPClient http;

      // Crear la URL con el habitacion_id
      String url = "http://" + String(server) + "/codigoazul/logica/alertas.php?habitacion_id=" + String(habitacion_id);

      Serial.print("Conectando a: ");
      Serial.println(url);

      // Inicia la conexión con el servidor
      http.begin(client, url);

      // Ejecuta la petición GET
      int httpCode = http.GET();

      // Verifica la respuesta del servidor
      if (httpCode > 0) {
        String payload = http.getString();
        Serial.println("Respuesta del servidor:");
        Serial.println(payload);
      } else {
        Serial.print("Error en la petición HTTP: ");
        Serial.println(httpCode);
      }

      http.end();  // Cierra la conexión
    } else {
      Serial.println("WiFi no conectado");
    }

    alreadySent = true;  // Marcar que la petición ya fue enviada
  } else if (buttonState == LOW) {
    alreadySent = false;  // Resetear bandera al soltar el botón
    digitalWrite(ledPin, LOW);  // Apaga el LED
    noTone(buzzerPin);          // Apaga el zumbador
  }
}

