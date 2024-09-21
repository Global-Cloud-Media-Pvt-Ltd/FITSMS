# Sri Lanka Smartest Online SMS Gateway Service API

This API allows you to send and receive SMS messages from your application through a reliable gateway. The service supports both single and bulk messaging with real-time status updates for delivery. Below is the detailed documentation to integrate the API with your system.

---

### API Endpoints:

#### 1. **Send SMS**
   - **URL**: `/api/v1/send-sms`
   - **Method**: `POST`
   - **Parameters**: 
      | Parameter     | Type       | Description |
      |---------------|------------|-------------|
      | `api_key`     | `string`   | API key provided after registration. |
      | `to`          | `string`   | Recipient mobile number in E.164 format. Example: +94770000000 |
      | `message`     | `string`   | The message to be sent, max length 160 characters. |
   - **Response**:
     - Example for single message:
       ```json
       {
         "status": "success",
         "message": "Message successfully sent.",
         "data": {
           "message_id": "MSGID_123456"
         }
       }
       ```
     - Example for multiple messages:
       ```json
       {
         "status": "success",
         "message": "Messages successfully sent.",
         "data": [
           {
             "message_id": "MSGID_123456"
           },
           {
             "message_id": "MSGID_123457"
           }
         ]
       }
       ```

---

#### 2. **Check Delivery Status**
   - **URL**: `/api/v1/delivery-status`
   - **Method**: `GET`
   - **Parameters**:
     | Parameter     | Type       | Description |
     |---------------|------------|-------------|
     | `api_key`     | `string`   | API key provided after registration. |
     | `message_id`  | `string`   | The message ID returned when the SMS was sent. |
   - **Response**:
     - Example response:
       ```json
       {
         "status": "success",
         "message": "Delivery status retrieved.",
         "data": {
           "message_id": "MSGID_123456",
           "status": "Delivered"
         }
       }
       ```

---

#### 3. **Balance Check**
   - **URL**: `/api/v1/balance`
   - **Method**: `GET`
   - **Parameters**:
     | Parameter     | Type       | Description |
     |---------------|------------|-------------|
     | `api_key`     | `string`   | API key provided after registration. |
   - **Response**:
     - Example response:
       ```json
       {
         "status": "success",
         "message": "Balance retrieved.",
         "data": {
           "balance": "100"
         }
       }
       ```

---

### Error Codes:

- **400 Bad Request**: The request was invalid or missing parameters.
- **401 Unauthorized**: The API key is invalid or missing.
- **500 Internal Server Error**: An unexpected error occurred.

---

### Sample Request for Single Number:
```bash
curl --request POST \
  --url 'https://api.example.com/v1/send-sms' \
  --header 'Content-Type: application/json' \
  --data '{
    "api_key": "your_api_key",
    "to": "+94770000000",
    "message": "Your message content"
  }
```
---

### Sample Request for Multiple Numbers:
```bash
curl --request POST \
  --url 'https://api.example.com/v1/send-sms' \
  --header 'Content-Type: application/json' \
  --data '{
    "api_key": "your_api_key",
    "to": ["+94770000000", "+94770000001"],
    "message": "Your message content"
  }
```

### Error Codes:

- **400 Bad Request**: The request was invalid or missing parameters.
- **401 Unauthorized**: The API key is invalid or missing.
- **500 Internal Server Error**: An unexpected error occurred.

---

### How to Register:

- Go to API registration page to obtain your API key.
- Integrate the API using the above endpoints.
- Test using the sample requests.

---

### This project is licensed under the MIT License.
