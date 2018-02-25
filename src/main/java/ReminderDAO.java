import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class ReminderDAO {
	
	private final static String databaseName = "HomeMaintenanceManager";
	private final static String host = "jdbc:mysql://localhost:3306/" + databaseName + "?autoReconnect=true&useSSL=false";
	private final static String username = "root";
	private final static String password = "hello";
	
	public ReminderDAO() {
		
	}
	
	private Connection getConnection() throws Exception {
		Class.forName("com.mysql.jdbc.Driver");
		return DriverManager.getConnection(host, username, password);
	}
	
	public ArrayList<TaskRecord> getAllTaskRecords() {
		ArrayList<TaskRecord> taskRecords = new ArrayList<TaskRecord>();
		TaskRecord currentRecord;
		
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
			
		try {
			conn = getConnection();
			stmt = conn.createStatement();
			String sql = "SELECT taskId, dueDate FROM Tasks";
			rs = stmt.executeQuery(sql);

			while (rs.next()) {
				int taskId = rs.getInt(1);
				Date date = rs.getDate(2);
				currentRecord = new TaskRecord(taskId, date);
				
				taskRecords.add(currentRecord);
			}

			conn.close();

		} catch (Exception e) {
			System.out.println(e);
		}
		
		
		return taskRecords;
	}
	
	public User getUser(int userID) {
		User user = null;
		
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
			
		try {
			conn = getConnection();
			stmt = conn.createStatement();
			String sql = "SELECT * FROM Users WHERE userId = " + userID;
			rs = stmt.executeQuery(sql);

			while (rs.next()) {
				int id = rs.getInt(1);
				String userName = rs.getString(3);
				String firstName = rs.getString(5);
				String lastName = rs.getString(6);
				String email = rs.getString(7);
				user = new User(id, userName, firstName, lastName, email);
			}

			conn.close();

		} catch (Exception e) {
			System.out.println(e);
		}
		
		return user;
	}
	
	public Task getTask(int taskID) {

		Task task = null;
		
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
			
		try {
			conn = getConnection();
			stmt = conn.createStatement();
			String sql = "SELECT * FROM Tasks WHERE taskId = " + taskID;
			rs = stmt.executeQuery(sql);

			while (rs.next()) {
				int id = rs.getInt(1);
				int usrId = rs.getInt(3);
				String name = rs.getString(4);
				String description = rs.getString(5);
				Date date = rs.getDate(7);
				
				task = new Task(id, usrId, name, description, date);
			}

			conn.close();

		} catch (Exception e) {
			System.out.println(e);
		}

		return task;
	}
	
	public void updateTask(int taskID) {
		
		//update task by setting day 1 ahead of current date. This ensures only 1 reminder sent per day.
		Date currentDate = new Date();
		Calendar calendar = Calendar.getInstance();
		calendar.setTime(currentDate);
		calendar.add(Calendar.DATE, 1);
		
		Date tomorrow = calendar.getTime();
		
		java.sql.Date sqlDate = new java.sql.Date(tomorrow.getTime());
		
		Connection conn = null;
		PreparedStatement pstmt = null;
			
		try {
			conn = getConnection();
			String sql = "UPDATE Tasks SET dueDate = ? WHERE taskId = ?";
			
			
			pstmt = conn.prepareStatement(sql);
			pstmt.setDate(1, sqlDate);
			pstmt.setInt(2, taskID);
			
			pstmt.execute();

			conn.close();

		} catch (Exception e) {
			System.out.println(e);
		}
		
		
	}
	
}
