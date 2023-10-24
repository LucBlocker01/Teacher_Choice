import React from "react";
import {Box} from "@mui/material";

function Index() {
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <img className="logo" src="{{ asset('/img/urca.png') }}" alt="" />
            <h1 className="title">Liste des matières par semestre</h1>

        </Box>
    )
}

export default Index;