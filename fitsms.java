import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

public class fitsms {
    private static final String API_URL = "https://app.fitsms.lk/api/v3/sms/send";
    private static final String API_TOKEN = "YOUR_API_KEY";
    private static final String SENDER_ID = "YOUR_MASK";
    private static final String RECIPIENTS = "YOUR_NUMBER_WITH_COUNTRY_CODE"; // IF MULTIPLE RECIPIENTS, USE A COMMA SEPARATED LIST

    public static void main(String[] args) {
        try {
            URL url = new URL(API_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setRequestProperty("Authorization", "Bearer " + API_TOKEN);
            conn.setRequestProperty("Content-Type", "application/json");
            conn.setRequestProperty("Accept", "application/json");
            conn.setDoOutput(true);

            String jsonBody = "{" +
                    "\"recipient\":\"" + RECIPIENTS + "\"," +
                    "\"sender_id\":\"" + SENDER_ID + "\"," +
                    "\"type\":\"plain\"," +
                    "\"message\":\"This is a test message\"," +
                    "\"schedule_time\":\"2021-12-20 07:00\"}";

            try (OutputStream os = conn.getOutputStream()) {
                byte[] input = jsonBody.getBytes("utf-8");
                os.write(input, 0, input.length);
            }

            int responseCode = conn.getResponseCode();
            if (responseCode == HttpURLConnection.HTTP_OK) {
                System.out.println("Message sent successfully.");
            } else {
                System.out.println("Failed to send message. Response Code: " + responseCode);
            }
            conn.disconnect();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
