import {Button, Container} from "@mui/material";
import React from "react";
import {Link} from "wouter";

function Home() {
    return (
        <Container sx={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            height: "100%",
        }}>
            <Link href="/react/choices">
            <Button sx={{
                border: 1,
                mt: "15%",
                mr: "7%",
                p: "15%",
                backgroundColor: "secondary.main",
            }}>Emettre ses voeux</Button>
            </Link>
            <Button sx={{
                border: 1,
                ml: "7%",
                mt: "15%",
                p: "15%",
                backgroundColor: "secondary.main",
            }}>Consulter son EDT</Button>
        </Container>
    );
}

export default Home;
