import React from 'react';
import {TextField} from "@mui/material";

function SearchTags({setInput}) {

    function handleChange(event) {
        setInput(event.target.value)
    }
    return (
        <>
        <TextField onChange={handleChange} placeholder="Rechercher tags..."/>
        </>
    )
}

export default SearchTags;