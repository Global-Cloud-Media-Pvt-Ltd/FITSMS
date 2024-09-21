﻿using System;
using System.Net.Http;
using System.Threading.Tasks;

namespace TestApp
{
    public class SmsService
    {
        private static readonly HttpClient client = new HttpClient();

        public async Task SendSmsAsync(string to, string message)
        {
            var request = new HttpRequestMessage(HttpMethod.Post, "https://app.fitsms.lk/api/v3/sms/send");

            request.Headers.Add("Authorization", "Bearer 100|YqDF3DyliXqCd5IEjEjaa5lyTyWACXFBaZ2OVlCG");

            var content = new StringContent($"{{\"recipient\":\"{to}\",\"message\":\"{message}\",\"type\":\"plain\",\"sender_id\":\"FitSMS Demo\"}}", System.Text.Encoding.UTF8, "application/json");
            request.Content = content;

            var response = await client.SendAsync(request);

            response.EnsureSuccessStatusCode();

            string responseBody = await response.Content.ReadAsStringAsync();

            Console.WriteLine(responseBody);
        }

        public static async Task Main(string[] args)
        {
            var smsService = new SmsService();
            await smsService.SendSmsAsync("+94761695904", "Test Message");
        }
    }
}
