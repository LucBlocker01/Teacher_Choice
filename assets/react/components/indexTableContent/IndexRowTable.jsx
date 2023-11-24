import React, {useEffect, useState} from "react";
import {fetchSubjectBySemester} from "../../services/api/choice";
import {Box, TableCell, TableRow, Typography} from "@mui/material";


function IndexRowTable({data, searchInput}) {
    const [cell, setCell] = useState(null);
    useEffect(() => {
        fetchSubjectBySemester(data.id).then((data) => {
            let content = data["hydra:member"].filter((subject) => subject.lessons.some((lesson) => lesson.tags.some((tag) => tag.name.toLowerCase().includes(searchInput.toLowerCase()))))
            setCell(content.map((subject) => subject.lessons.length < 1 ? null : (
                        <TableRow key={subject.id}>
                            <TableCell>
                                <Typography>{subject.name}</Typography>
                            </TableCell>
                            <TableCell>
                                {subject.lessons.map((lesson) => (
                                    <Typography key={lesson.id}>{lesson.name}</Typography>
                                ))}
                            </TableCell>
                            <TableCell>
                                {subject.lessons.map((lesson) => (
                                    <Box sx={{display: "flex", gap: 1, pl: "0"}}  key={lesson.id}>
                                        {lesson.tags.map((tag) => <Typography key={tag.id}>{tag.name}</Typography>)}
                                    </Box>
                                )
                                )}
                            </TableCell>
                        </TableRow>
                )
            ))
            })

        },[data, searchInput])
    return (
        <>
            {cell}
        </>
    )
}

export default IndexRowTable;

