import React, {useEffect, useState} from "react";
import {fetchSubjectBySemester} from "../../services/api/choice";
import {TableCell, TableRow, Typography} from "@mui/material";


function IndexRowTable({data}) {
    const [cell, setCell] = useState(null);
    useEffect(() => {
        fetchSubjectBySemester(data.id).then((data) => {
            setCell(data["hydra:member"].map((subject) => (
                <TableRow key={subject.id}>
                    <TableCell>
                        <Typography>{subject.name}</Typography>
                    </TableCell>
                    <TableCell>
                        <Typography>{subject.lessons.map((lesson) => lesson.name)}</Typography>
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

