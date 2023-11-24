import React from 'react';
import {Button, Input, TextField} from "@mui/material";

function SearchTags({setInput}) {

    function handleChange(event) {
        setInput(event.target.value)
    }
    return (
        <>
        <Input sx={{
            backgroundColor: "secondary.main",
            borderRadius: "4px",
            color: "text.main",
            padding: "0.5%"
        }}
                   onChange={handleChange}
                   placeholder="Rechercher tags..."/>
        </>
    )
}

export default SearchTags;