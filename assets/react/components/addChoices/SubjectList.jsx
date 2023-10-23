import React, { useEffect, useState } from 'react'
import { fetchSubjectBySemester } from "../../services/api/choice";
import SubjectItem from "./SubjectItem";

function SubjectList({ data }) {
  
  const [subjectList, setSubjectList] = useState(null);

    useEffect(() => {
        fetchSubjectBySemester(data).then((data) => {
            setSubjectList(data["hydra:member"].map((subject) => (
                <SubjectItem key={subject.id} data={subject} />
            )));
        });
    }, []);

    if (subjectList === null) {
        return <div>Loading...</div>;
    }

    return (
    <div>
        {subjectList}
    </div>
  )
}

export default SubjectList