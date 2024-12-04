# This file is to restore the database so you stop getting rick-rolled
import requests

# Define the URL of your PHP script
php_script_url = 'http://localhost/root/php/development-recovery.php'

# Send a GET request to the PHP script to clear the chat table
response = requests.get(php_script_url)

# Check the response
if response.status_code == 200:
    print("Successfully cleared the chat table.")
    print(response.text)  # Optionally print the response from PHP (success or error message)
else:
    print(f"Failed to trigger PHP script. Status code: {response.status_code}")
