import React, {useEffect, useState} from "react";
import {Box} from "@mui/material";
import useGetSemesters from "../hooks/useGetSemesters";


function Index() {
    const [semester, setSemesterData] = useState(undefined);
    useEffect(() => {
        async function grabSemester() {
            await useGetSemesters(semester, setSemesterData);
        }
        grabSemester();
    }, []);
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <h1 className="title">Liste des matières par semestre</h1>

        </Box>
    )
}

export default Index;