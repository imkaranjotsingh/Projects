'''
Created on Jan 10, 2017

@author: hanif
'''
from werkzeug.utils import secure_filename
import datetime
import os,sqlite3,hashlib
from module.Database import dba
from flask import Flask, flash, render_template, redirect, url_for, request, session

db = dba()

app = Flask(__name__)
app.secret_key = "mys3cr3tk3y"
UPLOAD_FOLDER = 'static/uploads'
ALLOWED_EXTENSIONS = set(['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif'])
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/about/')
def about():
    return render_template('about.html')

@app.route('/blog/')
def blog():
    return render_template('blog.html')


@app.route('/blog2/')
def blog2():
    return render_template('blog2.html')


@app.route('/contact/')
def contact():
    return render_template('contact.html')

@app.route('/gallery/')
def gallery():
    return render_template('gallery.html')

@app.route('/service/')
def service():
    return render_template('service.html')

@app.route('/typography/')
def typography():
    return render_template('typography.html')

@app.route('/login/')
def login():
    return render_template('login.html')


@app.route('/admin/')
def admin():
    return render_template('admin.html')
@app.route('/user/')
def user():
    return render_template('user.html')

@app.route('/error/')
def error():
    return render_template('error.html')

#uploading image process
@app.route('/img',methods = ['POST' , 'GET'])
def img():
    image = request.files['image']
    print(image)
    if image:
        filename = secure_filename(image.filename)
        image.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
        imagename = filename
        if db.insert_item(imagename ):
            flash("A new prodeuct have been added!!!!")
        else:
            flash("A product cannot be added!!!")
        return redirect(url_for('image'))
    else:
        return redirect(url_for('index'))
            

@app.route('/log',methods = [ 'POST' , 'GET'])
def log():
    if request.method == 'POST':
        print("post")
        n = db.check_login(request.form)
        if len(n) == 0:
            print("No data ")
            return redirect(url_for('error'))
        for row in n:
            a = row[3]
        if a == 'admin':
            return redirect(url_for('admin'))
        elif a == '':
            return redirect(url_for('user'))
        else:
            return redirect(url_for('invalid'))
    else:
        return redirect(url_for('index'))

@app.route('/delete/<int:id>/')
def delete(id):
    data = db.delete(id);
    return redirect(url_for('index'))
	
	
@app.route('/update/<int:id>/')
def update(id):
    data = db.read(id);
    if len(data) == 0:
        return redirect(url_for('index'))
    else:
        session['update'] = id
        return render_template('update.html', data = data)


@app.route('/updatephone', methods = ['POST'])
def updatephone():
    if request.method == 'POST' and request.form['update']:
        if db.update(session['update'], request.form):
            flash('updated')
        else:
            flash('can not be updated')
        
        session.pop('update', None)
        
        return redirect(url_for('index'))
    else:
        return redirect(url_for('index'))

	

@app.route('/reg',methods = ['POST' , 'GET'])
def reg():
    if request.method == 'POST' :
        print("Post Method!!")
        if db.insert(request.form):
            return redirect(url_for('index'))
        else:
            return redirect(url_for('error'))
    else:
        return redirect(url_for('error'))

	    

@app.errorhandler(404)
def page_not_found(error):
    return render_template('error.html')

if __name__ == '__main__':
    app.run(debug = True, port=8181, host="0.0.0.0")
