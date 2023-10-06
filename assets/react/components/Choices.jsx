import React from "react";
import {Button} from "@mui/material";
import Stack from '@mui/material/Stack';


function Choices() {
    return (
        <>
            <Stack spacing={2} sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                height: "100%",
                border: 1,
                backgroundColor: "primary.main",
                marginBottom: 2,
            }}>
                <div>item</div>
            </Stack>
            <Button sx={{
                border: 1,
                backgroundColor: "secondary.main",
            }}>
                Ajouter voeux
            </Button>
            <Button sx={{
                border: 1,
                backgroundColor: "secondary.main",
            }}>
                Valider voeux
            </Button>
        </>
    );
}

export default Choices;