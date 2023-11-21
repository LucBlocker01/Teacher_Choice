import React from 'react';
import {TextField} from "@mui/material";

function SearchTags({setInput}) {

    function handleChange(event) {
        setInput(event.target.value)
    }
    return (
        <>
        <TextField sx={{
            backgroundColor: "secondary.main",
            borderRadius: "4px",
            color: "text.main"
        }}
                   onChange={handleChange}
                   placeholder="Rechercher tags..."/>
        </>
    )
}

export default SearchTags;