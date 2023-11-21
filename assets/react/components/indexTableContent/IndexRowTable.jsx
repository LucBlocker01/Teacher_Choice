import React, {useEffect, useState} from "react";
import {fetchSubjectBySemester} from "../../services/api/choice";
import {Badge, TableCell, TableRow, Typography} from "@mui/material";


function IndexRowTable({data, searchInput}) {
    const [cell, setCell] = useState(null);
    useEffect(() => {
        fetchSubjectBySemester(data.id).then((data) => {
            setCell(data["hydra:member"].map((subject) => (
                <>
                { subject.lessons.length > 0 ?
                    <>
                        <TableRow key={subject.id}>
                            <TableCell>
                                <Typography>{subject.name}</Typography>
                            </TableCell>
                            <TableCell>
                                {subject.lessons.map((lesson) => (
                                    <Typography>{lesson.name}</Typography>
                                ))}
                            </TableCell>
                            <TableCell>
                                {subject.lessons.map((lesson) => (
                                    <Typography sx={{display: "flex", gap: 1}}>{lesson.tags.map((tag) => <Badge>{tag.name}</Badge>)}</Typography>
                                )
                                )}
                            </TableCell>
                        </TableRow>
                    </> : null }
                </>
            )))
            })

        },[data])
    return (
        <>
            {cell}
        </>
    )
}

export default IndexRowTable;

