import requests
import json

# FITSMS Configuration
FITSMS_ENDPOINT = "https://app.fitsms.lk/api/v3/sms/send"
FITSMS_SENDER_ID = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"  # Replace with your SENDER ID
FITSMS_AUTH_TOKEN = "+1xxxxxxxxxxxx"  # Replace with your FITSMS Auth Token

# Predefined list of recipients
RECIPIENTS = [
    "+94XXXXXXXXXXX"
]

def send_sms(number, message):
    # Process the phone number
    if number.startswith('0'):
        number = '94' + number.lstrip('0')
    elif number.startswith('+'):
        number = number.lstrip('+')
    elif not number.startswith('9'):
        number = '94' + number

    headers = {
        'Authorization': 'Bearer ' + FITSMS_AUTH_TOKEN,
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
    data = {
        'recipient': number,
        'sender_id': FITSMS_SENDER_ID,  # Replace with your sender ID
        'type': 'plain',
        'message': message
    }

    try:
        # Initialize the POST request
        response = requests.post(
            url=FITSMS_ENDPOINT, 
            headers=headers, 
            json=data
        )
        
        # Check for HTTP errors
        if response.status_code != 200:
            raise Exception(f"HTTP Error: {response.status_code} - {response.text}")

        response_data = response.json()
        
        # Check the API response for success
        if response_data.get('status') == 'success':
            print(f"Message sent successfully to {number}")
            return True
        else:
            error_message = response_data.get('message', 'Unknown error')
            print(f"Failed to send message to {number}: {error_message}")
            return False

    except Exception as e:
        print(f"Error sending SMS: {e}")
        return False
    

if __name__ == "__main__":
    # Send SMS to predefined list of recipients
    for recipient in RECIPIENTS:
        send_sms(recipient, "Hello, this is a test SMS from FITSMS.")