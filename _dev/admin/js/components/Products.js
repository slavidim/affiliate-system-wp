import React, { useEffect, useState } from 'react';
import Product from "./Product";

const Products = () => {
    const checkKey = window.checkKey ;
    const apiUrl = window.productsApiUrl;
    const loadMoreButton = document.getElementById('loadMoreButton');
    let limit = 1;
    let offSet = 0;

    const [data, setProducts] = useState([]);

    const loadProducts = () => {
        fetch(`https://fakeAPI/api/v3/products?pid=uid4356-40099934-38&offset=${offSet}&limit=${limit}` )
            .then((res)=>res.json())
            .then((data)=>{setProducts((prev) => [...prev, ...data.products])});
    }
    useEffect(()=>{
        loadProducts();
    },[]);

    const buttonClick = () => {
        offSet += 1;
        loadProducts();
    }

    loadMoreButton.addEventListener('click', buttonClick);

    if(checkKey === 'empty') {
        return (
            <div className={"containerProducts"}>
                <ul><li>Please Insert Client ID</li></ul>
            </div>
        )
    }
    return (
        <div className={"containerProducts"}>
            {data?.length > 0 && (
                <ul>
                    {data?.map(product => (
                        <Product key={product.id} {...product} />
                    ))}
                </ul>
            )}
        </div>
    );
}

export default Products;