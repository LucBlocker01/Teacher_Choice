import React, {useEffect, useState} from "react";
import {fetchSubjectBySemester} from "../../services/api/choice";
import {TableCell, TableRow, Typography} from "@mui/material";


function IndexRowTable({data}) {
    const [cell, setCell] = useState(null);
    useEffect(() => {
        fetchSubjectBySemester(data.id).then((data) => {
            console.log(data["hydra:member"])
            setCell(data["hydra:member"].map((subject) => (
                <TableRow>
                <TableCell key={subject.id}>
                    <Typography>{subject.name}</Typography>
                </TableCell>
                </TableRow>
            )))
            })

        },[]);
    return (
        <>
            {cell}
        </>
    )
}

export default IndexRowTable;

