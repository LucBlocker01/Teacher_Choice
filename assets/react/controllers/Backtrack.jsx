import React from 'react'
import {Button} from "@mui/material";

function Backtrack() {

    function handleClick() {
        window.history.back()
    }
    return (
        <Button onClick={handleClick}>
            Retour
        </Button>

    )
}

export default Backtrack