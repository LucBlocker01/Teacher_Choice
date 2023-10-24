import React, {useEffect, useState} from "react";
import {Box} from "@mui/material";
import useGetSemesters from "../hooks/useGetSemesters";


function Index() {
    const [semestersList, setSemesterList] = useState();
    useEffect(() => {
        useGetSemesters().then((data) => {
            setSemesterList(
                data["hydra:member"].map((semester) => (
                    <Box key={semester.id}>{semester.name}</Box>
                ))
            )
        })
    }, []);
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <h1 className="title">Liste des matières par semestre</h1>
            {semestersList}
        </Box>
    )
}

export default Index;