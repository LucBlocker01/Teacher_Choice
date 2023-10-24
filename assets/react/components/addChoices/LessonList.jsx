import React, { useState } from 'react'
import LessonItem from './LessonItem';

function LessonList({data}) {

    const [lessonsInfo, setLessonsInfo] = useState(null);

    const LessonClick = () => {
        setLessonsInfo(data["lessonInformation"].map((lessonInfo) => {
            return <LessonItem key={lessonInfo.id} data={lessonInfo} />
        }));
    }

  return (
    <div>
        <span onClick={LessonClick}>{data.name}</span>
        <div>
            {lessonsInfo}
            {console.log(lessonsInfo)}
        </div>
    </div>
  )
}

export default LessonList