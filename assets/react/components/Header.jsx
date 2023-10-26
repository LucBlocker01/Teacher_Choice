import React, {useEffect, useState} from 'react'
import {AppBar, Box, Button, Container, Link, Typography} from "@mui/material";
import useGetMe from "../hooks/useGetMe";


function Header({toggleTheme, isNormal}) {
    const [user, setUserData] = useState({});

    useEffect(() => {
        useGetMe().then((data) => {
            setUserData(data);
        })
    }, [])

    return (
        <Box sx={{
            mb: "100px",
        }}>

            <AppBar sx={{
                display: "flex",
                flexDirection: "row",
                alignItems: "center",
                backgroundColor: "primary.main",
            }}>
                <Container sx={{
                    m: '0'
                }}>
                    <p>SetURCAlendar</p>
                </Container>
                <Container sx={{
                    display: "flex",
                    justifyContent: "flex-end",
                }}>
                    {user !== null && user.status === "/api/statuses/1" ? <Link sx={{
                        textDecoration: "none",
                        mr: "3px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/excel">
                        <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        }}
                        >Excel</Button></Link>: null }
                    <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        mr: "3px",
                    }}
                            onClick={toggleTheme}
                    >{isNormal ? (
                        <Typography>Clair</Typography>
                    ) : (
                        <Typography>Sombre</Typography>
                    )}</Button>
                    { user !== null ?
                        <Link sx={{
                            textDecoration: "none",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/profil/${user.id}`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            >Profil</Button></Link> :
                        <Link sx={{
                            textDecoration: "none",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/login`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            >Se connecter</Button></Link>}

                </Container>

            </AppBar>
        </Box>
    )
}


export default Header;