from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)

menu = [
    {"id": 1, "name": "Espresso", "price": 2.50},
    {"id": 2, "name": "Latte", "price": 3.50},
    {"id": 3, "name": "Cappuccino", "price": 3.00},
    {"id": 4, "name": "Mocha", "price": 4.00}
]

cart = []

@app.route('/')
def index():
    return render_template('index.html', menu=menu)

@app.route('/add_to_cart', methods=['POST'])
def add_to_cart():
    item_id = int(request.form['item_id'])
    quantity = int(request.form['quantity'])
    item = next((item for item in menu if item['id'] == item_id), None)
    if item:
        item['quantity'] = quantity
        cart.append(item)
    return redirect(url_for('index'))

@app.route('/view_cart')
def view_cart():
    total_price = sum(item['price'] * item['quantity'] for item in cart)
    return render_template('cart.html', cart=cart, total_price=total_price)

@app.route('/place_order', methods=['POST'])
def place_order():
    global cart
    cart = []
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)
