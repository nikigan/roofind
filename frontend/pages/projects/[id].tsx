import { Box } from "@material-ui/core";
import { FC, useEffect } from "react";
import { GetStaticPaths, GetStaticProps } from "next";
import axios from "../../src/services/base";
import Project from "../../src/interfaces/project";
import { useRouter } from "next/router";
import { Skeleton } from "@material-ui/lab";

const ProjectPage: FC<Project> = ({ id, price, title, views, description }) => {
    const { isFallback } = useRouter();

    // @ts-ignore
    useEffect(async () => {
        await axios.post(`/projects/${id}/add-view`);
    }, []);

    if (isFallback) {
        return <Skeleton width="100%" height={400} />;
    }
    return (
        <Box>
            <h1>{title}</h1>
            <p>Просмотры: {views}</p>
            <p>Цена: {price.toFixed(0)}</p>
            <p>{description}</p>
        </Box>
    );
};

export const getStaticPaths: GetStaticPaths = async (context) => {
    const { data } = await axios.get("/project-ids");

    const paths = data.map((id) => ({
        params: {
            id: id.toString(),
        },
    }));

    return { paths, fallback: true };
};

export const getStaticProps: GetStaticProps = async ({ params }) => {
    const { data } = await axios.get(`/projects/${params.id}`);
    return {
        props: { ...data },
        revalidate: 1,
    };
};

export default ProjectPage;
