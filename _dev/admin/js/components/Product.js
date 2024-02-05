import React from "react";

const Product = ({ id, name, image, price, salePrice, description, clickUrl, inStock }) => {
    return (
        <>
        <li key={id}>
            <div
                className={"productItem " + (inStock !== true ? 'disabled':'')}
                data-id={id}
                data-title={name}
                data-price={price}
                data-sale={salePrice}
                data-description={description}
                data-click={clickUrl}
            >
                <div className={"productItem--image"}>
                    <img src={image.sizes.XLarge.url} alt={name} />
                </div>
                <h4>
                    {name.substring(0, 25)}...
                </h4>
                <div className={"productItem--description"}>
                    {description.substring(0, 50)}...
                </div>
                <div className={"productItem--price"}><strong>Price: ${price}</strong></div>
                <div className={"productItem--button"}>Add Product</div>
            </div>
        </li>
        </>
    );
};

export default Product;