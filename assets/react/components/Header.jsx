import React, {useEffect, useState} from 'react'
import {AppBar, Box, Button, Container, Link} from "@mui/material";
import useGetMe from "../hooks/useGetMe";
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
import NightlightRoundIcon from '@mui/icons-material/NightlightRound';
import WbSunnyIcon from '@mui/icons-material/WbSunny';
import PersonIcon from '@mui/icons-material/Person';
import LoginIcon from '@mui/icons-material/Login';
import LogoutIcon from '@mui/icons-material/Logout';
import ChecklistIcon from '@mui/icons-material/Checklist';
import ImportExportIcon from '@mui/icons-material/ImportExport';

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
                    m: '0',
                    display: "flex",
                    alignItems: "center"
                }}>
                    <Link href="/">
                        <img className="logo_header" src="/img/urca.png" alt="urca-logo" />
                    </Link>
                    ACCUEIL
                </Container>
                <Container sx={{
                    display: "flex",
                    justifyContent: "flex-end",
                }}>
                    {user !== null && user?.status?.name === "Admin" ? <Link sx={{
                        textDecoration: "none",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/excel">
                        <Button sx={{
                            backgroundColor: "accent.main",
                            color: "white",
                        }}
                        >
                            <ImportExportIcon></ImportExportIcon>
                            <Box>Import/Export Excel</Box>
                        </Button>
                    </Link>
                        : null
                    }
                    {user !== null && user?.status?.name === "Admin" ?
                        <Link sx={{
                        textDecoration: "none",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }} href="/admin">
                        <Button sx={{
                            backgroundColor: "accent.main",
                            color: "white",
                        }}
                        title="Admin">
                            <AdminPanelSettingsIcon></AdminPanelSettingsIcon>
                            <Box>Admin</Box>
                        </Button>
                        </Link>
                        : null }
                    <Button sx={{
                        backgroundColor: "accent.main",
                        color: "white",
                        mr: "5px",
                        "&:hover" : {
                            backgroundColor: "secondary.main",
                            borderRadius: "4px",
                        }
                    }}
                            onClick={toggleTheme}
                            title={"Changer thème"}
                    >{isNormal ?
                        <>
                            <WbSunnyIcon></WbSunnyIcon>
                            <Box sx={{
                                ml: "5px"
                            }}>Mode Clair</Box>
                        </>
                     :
                        <>
                            <NightlightRoundIcon></NightlightRoundIcon>
                            <Box>Mode Sombre</Box>
                        </>
                    } </Button>
                    { user !== null ?
                        <Link sx={{
                            textDecoration: "none",
                            mr: "5px",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/profil/${user.id}`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            title="Profil">
                                <PersonIcon></PersonIcon>
                                Profil
                            </Button></Link> :
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
                            >
                                <LoginIcon></LoginIcon>
                                <Box sx={{
                                    ml: "5px"
                                }}> Connexion</Box>
                            </Button></Link>}
                    { user !== null && user?.status?.name !== "Admin" ?
                        <Link href="/react/choices">
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                                textDecoration: "none",
                                mr: "5px",
                                "&:hover" : {
                                    backgroundColor: "secondary.main",
                                    borderRadius: "4px",
                                }
                        }} title="Voeux"
                        >
                            <ChecklistIcon />
                                <Box sx={{
                                    ml: "5px"
                                }}>Voeux</Box>
                        </Button>
                    </Link> : ""}
                    { user !== null ?
                        <Link sx={{
                            textDecoration: "none",
                            "&:hover" : {
                                backgroundColor: "secondary.main",
                                borderRadius: "4px",
                            }
                        }} href={`/logout`}>
                            <Button sx={{
                                backgroundColor: "accent.main",
                                color: "white",
                            }}
                            title="Logout">
                                <LogoutIcon></LogoutIcon>
                                <Box sx={{
                                    ml: "5px"
                                }}>Deconnexion</Box>
                            </Button>
                        </Link>
                            : null }
                </Container>
            </AppBar>
        </Box>
    )
}


export default Header;