
import pandas as pd
import sys
import numpy as np
import re 
import nltk
import pickle

from collections import Counter
from sklearn.pipeline import Pipeline
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.svm import LinearSVC
from sklearn.model_selection import GridSearchCV
from sklearn.feature_extraction.text import TfidfTransformer
from sklearn.feature_extraction import text 
from sklearn.multiclass import OneVsRestClassifier
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import confusion_matrix, accuracy_score
from sklearn.model_selection import train_test_split
from nltk import word_tokenize          
from nltk.stem import WordNetLemmatizer 
from nltk.stem import PorterStemmer
from nltk.corpus import stopwords


"""
class LemmaTokenizer:
  def __init__(self):
    self.wnl = WordNetLemmatizer()
   def __call__(self, doc):
      return [self.wnl.lemmatize(t) for t in word_tokenize(doc)]
"""
def stemmed_words(doc):
    return (stemmer.stem(w) for w in analyzer(doc))

def clean_str(string):
    """
    Tokenization/string cleaning for dataset
    Every dataset is lower cased except
    """
    string = re.sub(r"\n", "", str(string))    
    string = re.sub(r"\r", "", string) 
    string = re.sub(r"[0-9]", "digit", string)
    string = re.sub(r"\'", "", string)    
    string = re.sub(r"\"", "", string)    
    return string.strip().lower()

#nltk.download('all')
df = pd.read_csv('testtaskv2.csv')
my_stop_words = text.ENGLISH_STOP_WORDS


X = []
for i in range(df.shape[0]):
    X.append(clean_str(df.iloc[i][1]))
y = np.array(df["question_topic"])
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=5)

model = Pipeline([('vectorizer', CountVectorizer()),
    ('tfidf', TfidfTransformer()),
    ('clf', OneVsRestClassifier(LinearSVC(class_weight="balanced")))])

parameters = {'vectorizer__ngram_range': [(1, 1), (1, 2),(2,2)],
               'tfidf__use_idf': (True, False)}



model = Pipeline([('vectorizer', CountVectorizer(analyzer=stemmed_words, ngram_range=(1,2))),
    ('tfidf', TfidfTransformer(use_idf=True)),
    ('clf', OneVsRestClassifier(LinearSVC(class_weight="balanced")))])

model.fit(X_train, y_train)
pred = model.predict(X_test)
acc = accuracy_score(y_test, pred) * 100
print("Accuracy:  %.2f" %  acc)
#confusion_matrix(y_train, y_test)
#pickle.dump(model, open('taskmodel.pkl', 'wb'))
model = pickle.load(open('taskmodel.pkl', 'rb'))

question = input()

print(model.predict([question])[0])
