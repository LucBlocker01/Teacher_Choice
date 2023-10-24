import React, {useEffect, useState} from "react";
import {Box, Button} from "@mui/material";
import useGetSemesters from "../hooks/useGetSemesters";


function Index() {
    const [semestersList, setSemesterList] = useState();
    useEffect(() => {
        useGetSemesters().then((data) => {
            setSemesterList(
                data["hydra:member"].map((semester) => (
                    <Button sx={{
                        width: "12%",
                        mr: "3px",
                        fontSize: "2em",
                        backgroundColor: "accent.main",
                        color: "white"
                    }}
                            key={semester.id}>
                        {semester.name}
                    </Button>
                ))
            )
        })
    }, []);
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <h1 className="title">Liste des matières par semestre</h1>
            <Box sx={{
                display: "flex",
                justifyContent: "center",
            }}>
                {semestersList}
            </Box>

        </Box>
    )
}

export default Index;