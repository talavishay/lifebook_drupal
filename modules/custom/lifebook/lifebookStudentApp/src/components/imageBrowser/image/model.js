var m = {
	defaults : {
		url : "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM6c29kaXBvZGk9Imh0dHA6Ly9zb2RpcG9kaS5zb3VyY2Vmb3JnZS5uZXQvRFREL3NvZGlwb2RpLTAuZHRkIgogICB4bWxuczppbmtzY2FwZT0iaHR0cDovL3d3dy5pbmtzY2FwZS5vcmcvbmFtZXNwYWNlcy9pbmtzY2FwZSIKICAgd2lkdGg9IjMwMS45ODA1NiIKICAgaGVpZ2h0PSIzMDEuODY5NjMiCiAgIGlkPSJzdmcyIgogICB2ZXJzaW9uPSIxLjEiCiAgIGlua3NjYXBlOnZlcnNpb249IjAuNDguNSByMTAwNDAiCiAgIHNvZGlwb2RpOmRvY25hbWU9InN0YXIuc3ZnIj4KICA8bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGExMCI+CiAgICA8cmRmOlJERj4KICAgICAgPGNjOldvcmsKICAgICAgICAgcmRmOmFib3V0PSIiPgogICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2Uvc3ZnK3htbDwvZGM6Zm9ybWF0PgogICAgICAgIDxkYzp0eXBlCiAgICAgICAgICAgcmRmOnJlc291cmNlPSJodHRwOi8vcHVybC5vcmcvZGMvZGNtaXR5cGUvU3RpbGxJbWFnZSIgLz4KICAgICAgPC9jYzpXb3JrPgogICAgPC9yZGY6UkRGPgogIDwvbWV0YWRhdGE+CiAgPGRlZnMKICAgICBpZD0iZGVmczgiIC8+CiAgPHNvZGlwb2RpOm5hbWVkdmlldwogICAgIHBhZ2Vjb2xvcj0iI2ZmZmZmZiIKICAgICBib3JkZXJjb2xvcj0iIzY2NjY2NiIKICAgICBib3JkZXJvcGFjaXR5PSIxIgogICAgIG9iamVjdHRvbGVyYW5jZT0iMTAiCiAgICAgZ3JpZHRvbGVyYW5jZT0iMTAiCiAgICAgZ3VpZGV0b2xlcmFuY2U9IjEwIgogICAgIGlua3NjYXBlOnBhZ2VvcGFjaXR5PSIwIgogICAgIGlua3NjYXBlOnBhZ2VzaGFkb3c9IjIiCiAgICAgaW5rc2NhcGU6d2luZG93LXdpZHRoPSIxMjgwIgogICAgIGlua3NjYXBlOndpbmRvdy1oZWlnaHQ9IjczNCIKICAgICBpZD0ibmFtZWR2aWV3NiIKICAgICBzaG93Z3JpZD0iZmFsc2UiCiAgICAgaW5rc2NhcGU6em9vbT0iMS4zMDM3MjgxIgogICAgIGlua3NjYXBlOmN4PSI2OC44MjMzNzgiCiAgICAgaW5rc2NhcGU6Y3k9IjE5Mi4xOTk0NSIKICAgICBpbmtzY2FwZTp3aW5kb3cteD0iMCIKICAgICBpbmtzY2FwZTp3aW5kb3cteT0iMjciCiAgICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMSIKICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJzdmcyIgogICAgIGhlaWdodD0iNzQ0LjA5cHgiCiAgICAgZml0LW1hcmdpbi10b3A9IjAiCiAgICAgZml0LW1hcmdpbi1sZWZ0PSIwIgogICAgIGZpdC1tYXJnaW4tcmlnaHQ9IjAiCiAgICAgZml0LW1hcmdpbi1ib3R0b209IjAiCiAgICAgYm9yZGVybGF5ZXI9InRydWUiCiAgICAgaW5rc2NhcGU6c2hvd3BhZ2VzaGFkb3c9ImZhbHNlIgogICAgIHNob3dib3JkZXI9InRydWUiIC8+CiAgPHBhdGgKICAgICBkPSJtIDIzNi4xNzAyNywzMDEuODY5NjMgYyAtMi45MzgyLDAgLTUuNjk1MjgsLTAuODI1MTIgLTguMTcwNjEsLTIuNDk1NDYgbCAtNzcuMDM3MTMsLTUxLjk4MTk1IC03Ny4wNzczNzYsNTEuOTgxOTUgYyAtMi40NzUzMzEsMS42NzAzNCAtNS4zMzMwMywyLjQ5NTQ2IC04LjE3MDYwNCwyLjQ5NTQ2IC0yLjkxODA3MywwIC01LjgxNjAyMiwtMC44NjUzNiAtOC4zMTE0NzcsLTIuNTk2MDggLTQuOTUwNjYyLC0zLjQ0MTMyIC03LjI4NTEyLC05LjU1OTIxIC01Ljg3NjM5NSwtMTUuNDE1NDggTCA3NC4xMDY1MjUsMTg4LjY2ODUxIDQuODk3ODgzOSwxMjYuMTQxMjUgQyAwLjM2OTgzOTY2LDEyMi4xMTYzMiAtMS4xOTk4ODI0LDExNS42OTY1NiAwLjk1MzQ1NDI1LDExMC4wNDE1NCAzLjA4NjY2NjIsMTA0LjM2NjM5IDguNTIwMzE5MywxMDAuNjIzMjEgMTQuNTk3OTYxLDEwMC42MjMyMSBIIDEwMC4zMDg4MSBMIDEzNy4zOTg1Miw5LjIxNzA4NTYgQyAxMzkuNTkyMTEsMy42NDI1NiAxNDQuOTg1NTEsMCAxNTAuOTYyNTMsMCBjIDUuOTc3MDIsMCAxMS4zNTAzLDMuNjQyNTYgMTMuNTY0MDEsOS4yMTcwODU2IGwgMzcuMDI5MzUsOTEuNDA2MTI0NCBoIDg1Ljc3MTIyIGMgNi4xNTgxNCwwIDExLjQ3MTA0LDMuNzQzMTggMTMuNzQ1MTMsOS40MTgzMyAyLjA5Mjk2LDUuNjU1MDIgMC40ODI5OSwxMi4wOTQ5MSAtMy45NDQ0MywxNi4wOTk3MSBsIC02OS4yMDg2NCw2Mi41MjcyNiAyMi41NTk3Miw5NS4xODk1NiBjIDEuMzA4MSw1Ljg1NjI3IC0wLjk0NTg2LDExLjk3NDE2IC01Ljg5NjUyLDE1LjQxNTQ4IC0yLjU5NjA4LDEuNzMwNzIgLTUuNDk0MDMsMi41OTYwOCAtOC40MTIxLDIuNTk2MDggeiIKICAgICBpZD0icGF0aDQiCiAgICAgaW5rc2NhcGU6Y29ubmVjdG9yLWN1cnZhdHVyZT0iMCIKICAgICBzdHlsZT0iZmlsbDojZmZmZjAwIiAvPgo8L3N2Zz4K",
		//~ style : "box-s"
	}
};
module.exports = App.Backbone.Model.extend(m);
