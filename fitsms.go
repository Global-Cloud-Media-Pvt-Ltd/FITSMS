package main

import (
	"bytes"
	"encoding/json"
	"fmt"
	"io"
	"net/http"
)

// SMSRequest represents the request payload for sending an SMS
type SMSRequest struct {
	Recipient string `json:"recipient"`
	Message   string `json:"message"`
	Type      string `json:"type"`
	SenderID  string `json:"sender_id"`
}

const (
	apiURL   = "https://app.fitsms.lk/api/v3/sms/send"
	apiKey   = "YOUR_API_KEY" // Replace with your actual API key
	senderID = "YOUR_MASK"    // Replace with your sender ID
)

func sendSMS(to string, message string) {
	client := &http.Client{}

	// Create JSON payload
	payload := SMSRequest{
		Recipient: to,
		Message:   message,
		Type:      "plain",
		SenderID:  senderID,
	}

	jsonData, err := json.Marshal(payload)
	if err != nil {
		fmt.Println("Error encoding JSON:", err)
		return
	}

	// Create HTTP request
	req, err := http.NewRequest("POST", apiURL, bytes.NewBuffer(jsonData))
	if err != nil {
		fmt.Println("Error creating request:", err)
		return
	}

	req.Header.Set("Authorization", "Bearer "+apiKey)
	req.Header.Set("Content-Type", "application/json")

	// Send the request
	resp, err := client.Do(req)
	if err != nil {
		fmt.Println("Error sending request:", err)
		return
	}
	defer resp.Body.Close()

	// Read response
	body, err := io.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error reading response:", err)
		return
	}

	fmt.Println("Response:", string(body))
}

func main() {
	// Replace with actual phone number including country code
	sendSMS("YOUR_NUMBER_WITH_COUNTRY_CODE", "Test Message from Go!")
}

