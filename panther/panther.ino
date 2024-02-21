#include <DHT.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

#define DHTPIN 2  // replace with the appropriate pin
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "kan";
const char* password = "11112222";

const char* serverName = "http://192.168.137.228/data/post-esp-data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";
String sensorName = "DHT11";
String sensorLocation = "My Room";
 WiFiClient client;


void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  // Create a WiFiClient object
  WiFiClient client;
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(client, serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Read temperature, humidity, and pressure values
    float temperature = dht.readTemperature();
    float humidity = dht.readHumidity();
    
    // Prepare HTTP POST request data
    String httpRequestData = "api_key=" + apiKeyValue +
                            "&sensor=" + sensorName +
                            "&location=" + sensorLocation +
                            "&value1=" + String(temperature) +
                            "&value2=" + String(humidity);

    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);
    
    if (httpResponseCode > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    } else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }

    // Free resources
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }

  // Send an HTTP POST request every 15 seconds
  delay(15000);
}