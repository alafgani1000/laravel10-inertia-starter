import { Link } from "@inertiajs/react";

export default function NavLink({
    active = false,
    className = "",
    children,
    ...props
}) {
    return (
        <Link
            {...props}
            className={
                "inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none " +
                (active
                    ? "border-rose-500 text-gray-800 font-semibold focus:border-rose-500 "
                    : "border-transparent text-gray-800 hover:text-gray-800 hover:border-rose-500 focus:text-gray-800 focus:border-rose-500 ") +
                className
            }
        >
            {children}
        </Link>
    );
}
