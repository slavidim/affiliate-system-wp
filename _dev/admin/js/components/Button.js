import React from 'react';
function alertClick() {
    alert('Hello User');
}

const Button = (props) => {
    return (
        <button onClick={alertClick} id="openPopup">{props.text}</button>
    );
}

export default Button