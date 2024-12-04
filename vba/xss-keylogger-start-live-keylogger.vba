Option Explicit

Sub LiveKeystrokeLogger()
    Dim http As Object
    Dim keystrokes As String
    Dim ws As Worksheet
    Dim rowIndex As Long
    
    ' Set up worksheet and starting row
    Set ws = ThisWorkbook.Sheets(1)
    rowIndex = 1
    
    ' Loop to fetch keystrokes continuously
    Do
        ' Break infinite loop
        DoEvents
        
        ' Create a new HTTP request object
        Set http = CreateObject("MSXML2.XMLHTTP")
        
        ' Fetch keystrokes from the local server
        http.Open "GET", "http://localhost:8080/keystroke", False
        http.Send
        keystrokes = http.responseText
        
        ' Write the keystrokes into the Excel sheet
        If Len(keystrokes) > 0 Then
            ws.Cells(rowIndex, 2).Value = keystrokes
            rowIndex = rowIndex + 1
        End If
        
        ' Delay before next poll
        Application.Wait Now + TimeValue("00:00:03")
    Loop
End Sub
