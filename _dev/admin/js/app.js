console.log('Hello Admin');
import React from 'react'
import ReactDOM from "react-dom/client";
import Button from "./components/Button";
import Products from "./components/Products";

window.onload = () => {
    /**
     * Check User Key.
     **/
    const checkKey = window.checkKey ;

    /**
     * DOM elements.
     **/
     // Store Button
    const buttonRoot = ReactDOM.createRoot(
        document.getElementById('wooshop-button')
    );

    /**
     * Button for Open Store.
    **/
    if(document.getElementById('woocommerce-product-data') === null) {
        buttonRoot.render(
            <div className="wooNotify">Please open single product</div>
        );
    } else {
        buttonRoot.render(
            <Button text="Open Store" />
        );
    }

    /**
     * Render Products in Options Page.
     **/
    if(document.getElementById('wooshopProducts') != null) {
        const wooshopProducts = ReactDOM.createRoot(
            document.getElementById('wooshopProducts')
        );
        wooshopProducts.render(
            <Products />
        );
    }
}