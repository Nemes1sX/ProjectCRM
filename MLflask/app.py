
from os import environ
from flask import Flask, render_template, jsonify, request
from flask_cors import CORS
import pickle


model = pickle.load(open('taskmodel.pkl', 'rb'))

app = Flask(__name__)

CORS(app)
if __name__ == '__main__':
    HOST = environ.get('SERVER_HOST', 'localhost')
    try:
        PORT = int(environ.get('SERVER_PORT', '5555'))
    except ValueError:
        PORT = 5555
    app.run(HOST, PORT)

@app.route('/results', methods=['POST'])
def results():
    data = request.get_json()['title']
  
    input = [data]

    prediction = model.predict(input)

    response = {'role':  prediction[0]}
    return jsonify(response)
